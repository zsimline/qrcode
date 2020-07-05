const getMoment = (): string => {
  const date = new Date()

  return (
    'qrcode-' +
    date.getFullYear() +
    String(date.getMonth() + 1).padStart(2, '0') +
    String(date.getDate()).padStart(2, '0') +
    '_' +
    date.getHours() +
    date.getMinutes() +
    date.getSeconds()
  )
}

export { getMoment }
