import React from "react"
import { makeStyles, useTheme } from '@material-ui/core/styles'
import { Button, Grid, Typography } from "@material-ui/core"

function Sign() {
  const classes = useStyles()
  const theme = useTheme()

  return (
    <Grid container spacing={2} className={classes.root}>
      <Grid item xs={6} style={{ padding: 0, overflow: 'hidden', height: '100%' }}>
        <img
          src="http://pic.netbian.com/uploads/allimg/210114/231533-1610637333a1e0.jpg"
          className={classes.image}
        />
      </Grid>
      <Grid item xs={6}>
        <Grid 
          container 
          spacing={8} 
          alignItems="center" 
          justify="center" 
          style={{height: '100%'}} 
          direction="column"
        >
          <Grid item >
            <Typography variant="h4">Welecome To Mozi.</Typography>
          </Grid>
          <Grid>
            <Button
              variant="contained"
              color="primary"
              classes={{ root: classes.btnSignup }}
            >注册</Button>
          </Grid>
          <Grid item>
            <Button
              variant="outlined"
              classes={{ root: classes.btnSignin }}
              style={{
                color: theme.palette.primary.main,
                borderColor: theme.palette.primary.main
              }}
            >登录</Button>
          </Grid>
        </Grid>
      </Grid>
    </Grid>
  )
}

const useStyles = makeStyles({
  root: {
    display: 'flex',
    width: '80vw',
    height: '80vh',
    boxShadow: '0px 0px 10px #ddd',
    borderRadius: 16,
    margin: '10vh 10vw'
  },
  image: {
    width: '100%',
    borderRadius: 16
  },
  grid: {
    padding: 0,
    overflow: 'hidden',
    height: '100%'
  },
  btnSignin: {
    lineHeight: '32px',
    width: 360,
    borderRadius: 16,

  },
  btnSignup: {
    lineHeight: '32px',
    width: 360,
    borderRadius: 16
  }
}, { name: 'Sign' })

export default Sign
