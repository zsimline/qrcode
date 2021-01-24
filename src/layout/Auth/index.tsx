import React, { useState } from "react"
import { Box, Grid } from "@material-ui/core"
import classNames from 'classnames'
import Poster from "./Poster"
import Start from "./Start"
import SignIn from "./SignIn"
import SignUp from "./SignUp"
import useStyles from "./styles"

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

export default Auth
