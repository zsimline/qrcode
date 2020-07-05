import React, { useState } from 'react'
import { TextField, Button } from '@material-ui/core'

import { createQRCodeInBrowser } from '../utils/qrcode'

import styles from './index.css'

const App = (): JSX.Element => {
  const [content, setContent] = useState<string>('')

  const handleClick = () => {
    createQRCodeInBrowser(
      document.getElementById('view') as HTMLCanvasElement,
      content
    )
  }

  const handleChange = (e: any) => {
    setContent(e.target.value)
  }

  return (
    <div>
      <TextField
        multiline
        label="输入文字内容"
        variant="outlined"
        onChange={handleChange}
      />
      <canvas id="view" width="420px" height="420px">
        您的浏览器不支持Canvas
      </canvas>
      <Button onClick={handleClick} className={styles.button}>
        点击
      </Button>
    </div>
  )
}

export default App
