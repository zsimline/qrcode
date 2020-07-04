import QRCode from 'qrcode'

const createQRCodeInBrowser = (
  dom: HTMLCanvasElement,
  content: string
): void => {
  QRCode.toCanvas(dom, content)
}

export { createQRCodeInBrowser }
