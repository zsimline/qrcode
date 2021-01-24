import React from 'react'
import { createMuiTheme, ThemeProvider } from '@material-ui/core/styles'

import Auth from './layout/Auth'

const theme = createMuiTheme({
  palette: {
    primary: {
      main: '#1DA1F2',
      contrastText: '#fff',
    },
    text: {
      primary: '#34495E'
    }
  },
  // overrides: {
  //   MuiOutlinedInput: {
  //     input: {
  //       padding: '8px 16px'
  //     }
  //   }
  // }
})

function App() {
  return (
    <ThemeProvider theme={theme}>
      <Auth />
    </ThemeProvider>
  )
}

export default App
