import QRCode from 'qrcode'
import { getMoment } from './time'

const createQRCodeInBrowser = (
  dom: HTMLCanvasElement,
  content: string
): void => {
  QRCode.toCanvas(dom, content, {
    width: 300,
  })
}

const saveQRCode = (
  view: HTMLCanvasElement,
  download: HTMLLinkElement
): void => {
  download.href = view.toDataURL('image/png')
  download.download = getMoment()
  download.click()
}

export { createQRCodeInBrowser, saveQRCode }
