/* eslint-disable no-useless-escape */
export const SERVICES = {
  twitter: {
    component: 'Twitter',
    defaults: {
      align: 'center',
      dark: false,
      dnt: true,
      hideCards: false,
      maxWidth: 550,
      showConversation: false
    },
    regex: /^https?:\/\/twitter\.com\/(?:#!\/)?(\w+)\/status(?:es)?\/(\d+?.*)?$/,
    sanitizeInput: (input) => {
      const inputURL = new URL(input)
      return new URL(inputURL.pathname, inputURL.href).href
    }
  },
  youtube: {
    component: 'YouTube',
    defaults: {
      width: 640,
      height: 360,
      playerSettings: {
        autoplay: 0, // 0 ou 1
        cc_load_policy: 1, // Forçar legendas null ou 1
        color: 'red', // Cor da barra de progresso 'red' ou 'white'
        controls: 2, // Mostrar controles 0 mostra, 2 não mostra
        end: null,
        fs: 1, // Permitir tela cheia
        hl: 'pt', // Idioma do player: código de duas letras https://www.loc.gov/standards/iso639-2/php/code_list.php
        iv_load_policy: 1, // Exibir anotações 1 mostra, 3 não mostra
        loop: 0, // repetir
        modestbranding: 1, // esconder logo do youtube, null para mostrar,
        rel: 0, // mostrar vídeo relacionados ao final 0 ou 1,
        showinfo: 0, //  mostrar título e autor,
        start: null
      }
    },
    regex: /(?:https?:\/\/)?(?:www\.)?(?:(?:youtu\.be\/)|(?:youtube\.com)\/(?:v\/|u\/\w\/|embed\/|watch|shorts\/))(?:(?:\?v=)?([^#&?=]*))?((?:[?&]\w*=\w*)*)/
    // embedUrl: 'https://www.youtube.com/embed/<%= remote_id %>',
    // html: '<iframe style="width:100%;" height="320" frameborder="0" allowfullscreen></iframe>',
    // id: ([id, params]) => {
    //   if (!params && id) {
    //     return id
    //   }

    //   const paramsMap = {
    //     start: 'start',
    //     end: 'end',
    //     t: 'start',
    //     // eslint-disable-next-line camelcase
    //     time_continue: 'start',
    //     list: 'list'
    //   }

    //   params = params.slice(1)
    //     .split('&')
    //     .map(param => {
    //       const [name, value] = param.split('=')

    //       if (!id && name === 'v') {
    //         id = value

    //         return null
    //       }

    //       if (!paramsMap[name]) {
    //         return null
    //       }

    //       if (value === 'LL' ||
    //         value.startsWith('RDMM') ||
    //         value.startsWith('FL')) {
    //         return null
    //       }

    //       return `${paramsMap[name]}=${value}`
    //     })
    //     .filter(param => !!param)

    //   return id + '?' + params.join('&')
    // }
  }
  // vimeo: {
  //   regex: /(?:http[s]?:\/\/)?(?:www.)?(?:player.)?vimeo\.co(?:.+\/([^\/]\d+)(?:#t=[\d]+)?s?$)/,
  //   embedUrl: 'https://player.vimeo.com/video/<%= remote_id %>?title=0&byline=0',
  //   html: '<iframe style="width:100%;" height="320" frameborder="0"></iframe>',
  //   height: 320,
  //   width: 580
  // },
  // coub: {
  //   regex: /https?:\/\/coub\.com\/view\/([^\/\?\&]+)/,
  //   embedUrl: 'https://coub.com/embed/<%= remote_id %>',
  //   html: '<iframe style="width:100%;" height="320" frameborder="0" allowfullscreen></iframe>',
  //   height: 320,
  //   width: 580
  // },
  // vine: {
  //   regex: /https?:\/\/vine\.co\/v\/([^\/\?\&]+)/,
  //   embedUrl: 'https://vine.co/v/<%= remote_id %>/embed/simple/',
  //   html: '<iframe style="width:100%;" height="320" frameborder="0" allowfullscreen></iframe>',
  //   height: 320,
  //   width: 580
  // },
  // imgur: {
  //   regex: /https?:\/\/(?:i\.)?imgur\.com.*\/([a-zA-Z0-9]+)(?:\.gifv)?/,
  //   embedUrl: 'http://imgur.com/<%= remote_id %>/embed',
  //   html: '<iframe allowfullscreen="true" scrolling="no" id="imgur-embed-iframe-pub-<%= remote_id %>" class="imgur-embed-iframe-pub" style="height: 500px; width: 100%; border: 1px solid #000"></iframe>',
  //   height: 500,
  //   width: 540
  // },
  // gfycat: {
  //   regex: /https?:\/\/gfycat\.com(?:\/detail)?\/([a-zA-Z]+)/,
  //   embedUrl: 'https://gfycat.com/ifr/<%= remote_id %>',
  //   html: "<iframe frameborder='0' scrolling='no' style=\"width:100%;\" height='436' allowfullscreen ></iframe>",
  //   height: 436,
  //   width: 580
  // },
  // 'twitch-channel': {
  //   regex: /https?:\/\/www\.twitch\.tv\/([^\/\?\&]*)\/?$/,
  //   embedUrl: 'https://player.twitch.tv/?channel=<%= remote_id %>',
  //   html: '<iframe frameborder="0" allowfullscreen="true" scrolling="no" height="366" style="width:100%;"></iframe>',
  //   height: 366,
  //   width: 600
  // },
  // 'twitch-video': {
  //   regex: /https?:\/\/www\.twitch\.tv\/(?:[^\/\?\&]*\/v|videos)\/([0-9]*)/,
  //   embedUrl: 'https://player.twitch.tv/?video=v<%= remote_id %>',
  //   html: '<iframe frameborder="0" allowfullscreen="true" scrolling="no" height="366" style="width:100%;"></iframe>',
  //   height: 366,
  //   width: 600
  // },
  // 'yandex-music-album': {
  //   regex: /https?:\/\/music\.yandex\.ru\/album\/([0-9]*)\/?$/,
  //   embedUrl: 'https://music\.yandex\.ru/iframe/#album/<%= remote_id %>/',
  //   html: '<iframe frameborder=\"0\" style=\"border:none;width:540px;height:400px;\" style=\"width:100%;\" height=\"400\"></iframe>',
  //   height: 400,
  //   width: 540
  // },
  // 'yandex-music-track': {
  //   regex: /https?:\/\/music\.yandex\.ru\/album\/([0-9]*)\/track\/([0-9]*)/,
  //   embedUrl: 'https://music\.yandex\.ru/iframe/#track/<%= remote_id %>/',
  //   html: '<iframe frameborder="0" style="border:none;width:540px;height:100px;" style="width:100%;" height="100"></iframe>',
  //   height: 100,
  //   width: 540,
  //   id: (ids) => ids.join('/')
  // },
  // 'yandex-music-playlist': {
  //   regex: /https?:\/\/music\.yandex\.ru\/users\/([^\/\?\&]*)\/playlists\/([0-9]*)/,
  //   embedUrl: 'https://music\.yandex\.ru/iframe/#playlist/<%= remote_id %>/show/cover/description/',
  //   html: '<iframe frameborder="0" style="border:none;width:540px;height:400px;" width="540" height="400"></iframe>',
  //   height: 400,
  //   width: 540,
  //   id: (ids) => ids.join('/')
  // },
  // codepen: {
  //   regex: /https?:\/\/codepen\.io\/([^\/\?\&]*)\/pen\/([^\/\?\&]*)/,
  //   embedUrl: 'https://codepen.io/<%= remote_id %>?height=300&theme-id=0&default-tab=css,result&embed-version=2',
  //   html: "<iframe height='300' scrolling='no' frameborder='no' allowtransparency='true' allowfullscreen='true' style='width: 100%;'></iframe>",
  //   height: 300,
  //   width: 600,
  //   id: (ids) => ids.join('/embed/')
  // },
  // instagram: {
  //   regex: /https?:\/\/www\.instagram\.com\/p\/([^\/\?\&]+)\/?.*/,
  //   embedUrl: 'https://www.instagram.com/p/<%= remote_id %>/embed',
  //   html: '<iframe width="400" height="505" style="margin: 0 auto;" frameborder="0" scrolling="no" allowtransparency="true"></iframe>',
  //   height: 505,
  //   width: 400
  // },
  // pinterest: {
  //   regex: /https?:\/\/([^\/\?\&]*).pinterest.com\/pin\/([^\/\?\&]*)\/?$/,
  //   embedUrl: 'https://assets.pinterest.com/ext/embed.html?id=<%= remote_id %>',
  //   html: "<iframe scrolling='no' frameborder='no' allowtransparency='true' allowfullscreen='true' style='width: 100%; min-height: 400px; max-height: 1000px;'></iframe>",
  //   id: (ids) => {
  //     return ids[1]
  //   }
  // },
  // facebook: {
  //   regex: /https?:\/\/www.facebook.com\/([^\/\?\&]*)\/(.*)/,
  //   embedUrl: 'https://www.facebook.com/plugins/post.php?href=https://www.facebook.com/<%= remote_id %>&width=500',
  //   html: "<iframe scrolling='no' frameborder='no' allowtransparency='true' allowfullscreen='true' style='width: 100%; min-height: 500px; max-height: 1000px;'></iframe>",
  //   id: (ids) => {
  //     return ids.join('/')
  //   }
  // },
  // aparat: {
  //   regex: /(?:http[s]?:\/\/)?(?:www.)?aparat\.com\/v\/([^\/\?\&]+)\/?/,
  //   embedUrl: 'https://www.aparat.com/video/video/embed/videohash/<%= remote_id %>/vt/frame',
  //   html: '<iframe width="600" height="300" style="margin: 0 auto;" frameborder="0" scrolling="no" allowtransparency="true"></iframe>',
  //   height: 300,
  //   width: 600
  // },
  // miro: {
  //   regex: /https:\/\/miro.com\/\S+(\S{12})\/(\S+)?/,
  //   embedUrl: 'https://miro.com/app/live-embed/<%= remote_id %>',
  //   html: '<iframe width="700" height="500" style="margin: 0 auto;" allowFullScreen frameBorder="0" scrolling="no"></iframe>'
  // }
}

export const PATTERNS = Object.entries(SERVICES)
  .reduce((result, [key, item]) => {
    result[key] = item.regex

    return result
  }, {})
