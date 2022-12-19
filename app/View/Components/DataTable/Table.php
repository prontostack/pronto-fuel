<?php

namespace App\View\Components\DataTable;

use App\View\Component;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

abstract class Table extends Component
{
    public $id = '';
    public $context;

    protected $headers = [];
    protected $searches = [];
    protected $sortOptions = [];
    protected $defaultSorts = [];
    protected $filters = [];
    protected $filter = [
        'params' => [],
        'labels' => []
    ];

    protected abstract function columns();
    protected abstract function filters();
    protected abstract function defaultSorts();
    protected abstract function query();
    protected abstract function partialReloads();

    public function __construct($context = [])
    {
        $this->context = $context;

        if (isset($context['id'])) {
            $this->id = $this->context['id'];
        }

        $this->processColumns();
        $this->processFilters();
        $this->setDefaultSorts();
    }

    protected function processColumns()
    {
        $columns = $this->columns();

        foreach ($columns as $key => $column) {
            $this->searches = array_replace_recursive($this->searches, $column->searches);
            $this->sortOptions = array_replace_recursive($this->sortOptions, $column->sorts);
            array_push($this->headers, $column->header);
        }
    }

    protected function processFilters()
    {
        $filters = $this->filters();

        foreach ($filters as $key => $filter) {
            $this->filters[$filter->parameter] = $filter;

            $this->filter['labels'] = array_replace_recursive($this->filter['labels'], [
                $filter->parameter => $filter->label
            ]);

            $this->filter['params'] = array_replace_recursive($this->filter['params'], [
                $filter->parameter => $filter->defaultValue
            ]);
        }
    }

    protected function setDefaultSorts()
    {
        foreach ($this->defaultSorts() as $key => $sort) {
            $defaultSorts = Arr::pluck($sort, 'value');
            $this->defaultSorts = array_replace_recursive($this->defaultSorts, $defaultSorts);
        }
    }

    protected function getResults()
    {
        $perPage = Request::input($this->prefix('per_page'));
        $pageName = $this->prefix('page');

        $results = $this->search()
            ->filter($this->requestedFilters())
            ->sort($this->requestedSorts(), $this->defaultSorts)
            ->paginate(intval($perPage), ['*'], $pageName);

        return $this->transformResults($results);
    }

    protected function search()
    {
        $query = $this->query();

        $search = Request::input($this->prefix('filter.search'));

        if (Str::of($search)->trim()->isNotEmpty()) {
            foreach ($this->searches as $key => $column) {
                $query->orWhere($column, 'ILIKE', "%$search%");
            }
        }

        return $query;
    }

    /**
     * This is a placeholder method that should be override
     * It is used to transform the results from the getResults method
     *
     * @param Array $filters
     * @return Array
     */
    protected function transformResults($results)
    {
        return $results;
    }

    public function getSelectedSorts()
    {
        $sortKey = $this->prefix('sort');

        return Request::has($sortKey) ? explode(',', Request::input($sortKey)) : $this->defaultSorts;
    }

    /**
     * Merge the filters available in the frontend with the requested filters
     *
     * The ones present in the request will have the incoming value
     * The ones absent from the request will have the default value
     *
     * @return void
     */
    public function getSelectedFilters()
    {
        $filters = $this->filter['params'];

        $requestFilters = $this->getRequestFilters();

        if ($requestFilters) {
            $filters = array_intersect_key($requestFilters, $this->filter['params']) + $this->filter['params'];
        }

        $filters = $this->prepareFiltersForClient($filters);

        return $filters;
    }

    /**
     * Check each filter and run the Closure passed via the prepareForClient method
     *
     * @param Array $filters
     * @return Array
     */
    public function prepareFiltersForClient($filters)
    {
        foreach ($filters as $key => $value) {
            if ($this->filters[$key]->clientConverter instanceof Closure) {
                $filters[$key] = ($this->filters[$key]->clientConverter)($value);
            }
        }

        return $filters;
    }

    protected function getRequestFilters()
    {
        $filterParam = $this->prefix('filter');

        if (!Request::has($filterParam) || !is_array(Request::input($filterParam)) || !Arr::isAssoc(Request::input($filterParam))) {
            return null;
        }

        return Request::input($filterParam);
    }

    /**
     * Get the filters from the request params
     * to be used on the Eloquent QueryBuilder
     */
    protected function requestedFilters($filters = null)
    {
        if (!$filters) {
            $filters = array_keys($this->filter['params']);
        }

        /**
         * Prefix each passed filter with the proper context
         */
        $filters = preg_filter('/^/', $this->prefix('filter') . '.', $filters);

        $filters = Request::only($filters);

        return Arr::get($filters, $this->prefix('filter'));
    }

    /**
     * Get the sorts from the request params
     * to be used on the Eloquent QueryBuilder
     */
    protected function requestedSorts($sorts = null)
    {
        if (!$sorts) {
            $sorts = Arr::pluck($this->sortOptions, 'value');
        }

        $incomingSorts = explode(',', Request::input($this->prefix('sort')));

        return array_intersect($incomingSorts, $sorts);
    }

    /**
     * Prefix a string with the DataTable id
     */
    protected function prefix($str, $separator = '.')
    {
        if (Str::of($this->id)->isEmpty()) {
            return $str;
        }

        return $this->id . $separator . $str;
    }

    protected function getPartialReloads()
    {
        if (isset($this->context['only'])) {
            return $this->context['only'];
        }

        return $this->partialReloads();
    }

    /**
     * Appends the attributes for the get[attributeName]Attribute methods
     *
     * @param Array $arr
     * @return Array
     */
    protected function mergeAttributes($arr)
    {
        $methods = get_class_methods($this);

        foreach ($methods as $key => $method) {
            if (Str::startsWith($method, 'get') && Str::endsWith($method, 'Attribute')) {
                $property = (string) Str::of($method)->after('get')->before('Attribute')->snake();
                $arr[$property] = $this->{$method}();
            }
        }

        return $arr;
    }

    public function jsonSerialize()
    {
        $arr = [
            'id' => $this->id,
            'only' => $this->getPartialReloads(),
            'headers' => $this->headers,
            'results' => $this->getResults(),
            'filter' => [
                'params' => $this->getSelectedFilters(),
                'labels' => $this->filter['labels']
            ],
            'sort_options' => $this->sortOptions,
            'sorts' => $this->getSelectedSorts(),
            'loading' => false,
            'selected' => []
        ];

        return $this->mergeAttributes($arr);
    }
}
