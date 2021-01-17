import React from 'react'
import { createMuiTheme, ThemeProvider } from '@material-ui/core/styles'

import Sign from './layout/Sign'

const theme = createMuiTheme({
  palette: {
    primary: {
      main: '#1DA1F2',
      contrastText: '#fff',
    }
  },
})

function App() {
  return (
    <ThemeProvider theme={theme}>
    <Sign />
    </ThemeProvider>

  )
}

export default App
