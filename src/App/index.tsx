import React, { useState, useCallback, FC } from 'react'
import { Grid, TextField, Button, Tabs, Tab } from '@material-ui/core'

import { useEffectOnce, useCallbackOnce } from 'utils/hooks'
import { $ } from 'utils/tools'
import { createQRCodeInBrowser, saveQRCode } from 'utils/qrcode'

import Advanced from './tabs/Advanced'
import styles from './index.css'
import Color from './tabs/Color'

// 初始化画布
const initCanvas = (view: HTMLCanvasElement): void => {
  const ctx = view.getContext('2d') as CanvasRenderingContext2D
  const numX = 300 / 12,
    numY = 300 / 12
  for (let i = 0; i < numX; i++) {
    for (let j = 0; j < numY; j++) {
      ctx.fillStyle = i % 2 === j % 2 ? '#CCCCCC' : '#FFFFFF'
      ctx.fillRect(i * 12, j * 12, 12, 12)
    }
  }
}

const App: FC = (): JSX.Element => {
  const [view, setView] = useState<HTMLCanvasElement>()
  const [download, setDownload] = useState<HTMLLinkElement>()
  const [content, setContent] = useState<string>('')
  const [tabValue, setTabValue] = useState<number>(0)

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

  const handleTabChange = useCallbackOnce((e, newValue: number) => {
    setTabValue(newValue)
  })

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
              <Tabs
                value={tabValue}
                indicatorColor="primary"
                textColor="primary"
                onChange={handleTabChange}
              >
                <Tab value={0} label="颜色" />
                <Tab value={1} label="形状" />
                <Tab value={2} label="高级" />
              </Tabs>
              <div>
                <Color index={0} value={tabValue} />
                <Advanced index={1} value={tabValue} />
              </div>
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
