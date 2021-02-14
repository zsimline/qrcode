import React from "react"
import { Fab, Grid } from "@material-ui/core"
import { makeStyles } from '@material-ui/core/styles'
import Posts from "./Posts"
import Sidebar from "./Sidebar"
import { AddOutlined } from "@material-ui/icons"

function Home() {
  const styles = useStyles()

  return (
    <Grid container className={styles.root}>
      <Grid item xs={3}>
        <Sidebar />
      </Grid>
      <Grid item xs={5}>
        <Posts />
      </Grid>
      <Grid item xs={4}></Grid>
    </Grid>
  )
}

const useStyles = makeStyles({
  root: {
    backgroundColor: '#fff'
  }
}, { name: 'Sidebar' })

export default Home
