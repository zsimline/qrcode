import React from "react"
import { Grid, Typography, Button  } from "@material-ui/core"
import { makeStyles, useTheme } from "@material-ui/core/styles"
import classNames from "classnames"

interface Props {
  onStart: () => void
}

function Start(props: Props) {
  const styles = useStyles()
  const theme = useTheme()

  return (
    <Grid
      container
      spacing={8}
      alignItems="center"
      justify="center"
      direction="column"
      className={classNames(styles.page, styles.pageFront)}
    >
      <Grid item>
        <Typography variant="h4">Welecome To Mozi.</Typography>
      </Grid>
      <Grid item>
        <Button
          variant="contained"
          color="primary"
          classes={{ root: styles.btnStart }}
          onClick={props.onStart}
        >开始</Button>
      </Grid>
    </Grid>
  )
}

const useStyles = makeStyles({
  btnStart: {
    width: 416,
    lineHeight: '32px',
    borderRadius: 20,
    color: '#fff'
  },
  page: {
    position: 'absolute',
    background: '#fff',
    margin: 0,
    width: '100%',
    height: '100%'
  },
  pageFront: {
    transform: 'translateZ(1px)'
  },
}, { name: 'Auth' })

export default Start
