import React from "react"
import { Grid, Typography, Button } from "@material-ui/core"
import classNames from "classnames"
import useStyles from "./styles"

interface Props {
  onStart: () => void
}

function Start(props: Props) {
  const styles = useStyles()

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
          classes={{ root: styles.btnSignup }}
          onClick={props.onStart}
        >开始</Button>
      </Grid>
    </Grid>
  )
}

export default Start
