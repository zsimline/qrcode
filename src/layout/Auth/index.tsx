import React, { useState } from "react"
import { Box, Grid } from "@material-ui/core"
import { makeStyles } from '@material-ui/core/styles'
import classNames from 'classnames'
import Poster from "./Poster"
import Start from "./Start"
import SignIn from "./SignIn"
import SignUp from "./SignUp"

function Auth() {
  const styles = useStyles()
  const [isTurned, setIsTurned] = useState<boolean>(false)

  return (
    <Grid container spacing={2} className={styles.root}>
      <Grid item xs={6} style={{ position: 'relative', padding: 0 }}>
        <Box className={styles.paper}>
          <Poster />
        </Box>
      </Grid>
      <Grid item xs={6} style={{ position: 'relative', padding: 0 }}>
        <Box className={styles.paper}>
          <SignUp />
        </Box>
        <Box className={classNames(styles.paper, { [styles.turnPage]: isTurned })}>
          <Start onStart={() => setIsTurned(true)} />
          <SignIn />
        </Box>
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
    margin: '10vh 10vw'
  },
  paper: {
    position: 'absolute',
    width: '100%',
    height: '100%',
    transformOrigin: 'left center',
    transformStyle: 'preserve-3d',
    transition: 'transform 1s ease'
  },
  turnPage: {
    transform: 'perspective(1800px) rotateY(-180deg)'
  },
}, { name: 'Auth' })

export default Auth
