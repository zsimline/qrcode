const $ = (id: string): HTMLElement | null => {
  return document.getElementById(id)
}

export { $ }
