import React, { useState, useCallback } from 'react'
import { Grid, TextField, Button } from '@material-ui/core'

import { useEffectOnce } from 'utils/hooks'
import { $ } from 'utils/tools'
import { createQRCodeInBrowser, saveQRCode } from 'utils/qrcode'
import styles from './index.css'

// 初始化画布
const initCanvas = (view: HTMLCanvasElement): void => {
  const ctx = view.getContext('2d') as CanvasRenderingContext2D
  const numX = 300 / 12,
    numY = 300 / 12
  for (let i = 0; i < numX; i++) {
    for (let j = 0; j < numY; j++) {
      ctx.fillStyle = i % 2 === j % 2 ? '#c6c6c6' : '#f7f7f7'
      ctx.fillRect(i * 12, j * 12, 12, 12)
    }
  }
}

const App = (): JSX.Element => {
  const [view, setView] = useState<HTMLCanvasElement>()
  const [download, setDownload] = useState<HTMLLinkElement>()
  const [content, setContent] = useState<string>('')

  useEffectOnce(() => {
    const view = $('view') as HTMLCanvasElement
    const download = $('download') as HTMLLinkElement

    setView(view)
    setDownload(download)
    initCanvas(view)
  })

  // eslint-disable-next-line @typescript-eslint/no-explicit-any
  const handleChange = useCallback(
    (e: any) => {
      const content = e.target.value
      if (!content) {
        initCanvas(view)
        return
      }
      setContent(content)
      createQRCodeInBrowser(view, content)
    },
    [content]
  )

  const handleSaveButtonClick = () => {
    saveQRCode(view, download)
  }

  return (
    <div>
      <Grid
        container
        direction="row"
        justify="center"
        alignItems="stretch"
        className={styles.main}
      >
        <Grid item xs={8}>
          <TextField
            multiline
            label="输入文字内容"
            variant="outlined"
            onChange={handleChange}
            className={styles.textArea}
            data-role="text-area"
          />
        </Grid>
        <Grid item xs={4}>
          <Grid container>
            <Grid item xs={12} className="text-center">
              <canvas id="view" width="300px" height="300px">
                您的浏览器不支持Canvas
              </canvas>
            </Grid>
            <Grid item xs={12}>
              <Button
                variant="contained"
                color="primary"
                onClick={handleSaveButtonClick}
              >
                保存图片
              </Button>
              <a
                id="download"
                download={'nnn'}
                style={{ display: 'none' }}
                href=""
              ></a>
            </Grid>
          </Grid>
        </Grid>
      </Grid>
    </div>
  )
}

export default App
