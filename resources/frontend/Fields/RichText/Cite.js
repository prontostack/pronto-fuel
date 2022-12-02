export default class CiteTool {
  static get isInline () {
    return true
  }

  constructor ({ api }) {
    this.api = api
    this.button = null
    this._state = false
    this.tag = 'CITE'
  }

  get state () {
    return this._state
  }

  set state (state) {
    this._state = state

    this.button.classList.toggle(this.api.styles.inlineToolButtonActive, state)
  }

  render () {
    this.button = document.createElement('button')
    this.button.type = 'button'
    this.button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 1200 1200"><path fill="currentColor" d="M454.771 10.997c-76.209-40.113-226.406 37.395-269.553 105.63c-19.222 30.534-17.862 52.538-17.862 65.022v667.874L730.602 1200l105.917-57.833V491.739L258.215 159.706c31.033-39.057 100.827-86.683 153.16-67.555l515.104 275.498l.001 724.58l106.184-57.936V309.728L454.771 10.997z"/></svg>'
    this.button.classList.add(this.api.styles.inlineToolButton)

    return this.button
  }

  surround (range) {
    if (this.state) {
      this.unwrap(range)
      return
    }

    this.wrap(range)
  }

  wrap (range) {
    const selectedText = range.extractContents()
    const cite = document.createElement(this.tag)

    cite.classList.add('cdx-cite')
    cite.appendChild(selectedText)
    range.insertNode(cite)

    this.api.selection.expandToTag(cite)
  }

  unwrap (range) {
    const cite = this.api.selection.findParentTag(this.tag)
    const text = range.extractContents()

    cite.remove()

    range.insertNode(text)
  }

  checkState (selection) {
    const cite = this.api.selection.findParentTag(this.tag)

    this.state = !!cite
  }

  static get sanitize () {
    return {
      cite: {
        class: 'cdx-cite'
      }
    }
  }
}
