export const addScript = (src, cb) => {
  if (document.querySelector(`script[src="${src}"]`)) {
    return
  }

  let script = document.createElement('script')

  script.src = src
  script.async = true
  script.defer = true

  script = cb(script)

  document.body.appendChild(script)
}

export const twitter = () => {
  window.twttr = (function (d, s, id) {
    const fjs = d.getElementsByTagName(s)[0]
    const t = window.twttr || {}

    if (d.getElementById(id)) return t

    const js = d.createElement(s)

    js.id = id
    js.src = 'https://platform.twitter.com/widgets.js'
    fjs.parentNode.insertBefore(js, fjs)

    t._e = []
    t.ready = function (f) {
      t._e.push(f)
    }

    return t
  }(document, 'script', 'twitter-wjs'))
}
