export default (selector, timeout = 1000) => {
  return new Promise((resolve, reject) => {
    const interval = 10
    let counter = 0

    const handler = setInterval(() => {
      const element = document.querySelector(selector)

      if (element) {
        clearInterval(handler)
        resolve(element)
      }

      if (counter > timeout) {
        clearInterval(handler)
        reject(new Error(`Element not found: ${selector}`))
      }

      counter += interval
    }, interval)
  })
}
