import React from 'react'
import { createMuiTheme, ThemeProvider } from '@material-ui/core/styles'
import { BrowserRouter, Route } from 'react-router-dom'
import Auth from './layout/Auth'
import Home from './layout/Home'

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
      <BrowserRouter>
        <Route path="/" exact component={Home} />
        <Route path="/auth" exact component={Auth} />
      </BrowserRouter>
    </ThemeProvider>
  )
}

export default App
