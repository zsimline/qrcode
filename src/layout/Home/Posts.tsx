import React from "react"
import { Box, Grid } from "@material-ui/core"
import { makeStyles } from '@material-ui/core/styles'

function Posts() {
  const styles = useStyles()

  return (
    <Box className={styles.root}>
      
    </Box>
  )
}

const useStyles = makeStyles({
  root: {
    borderLeft: 'solid 1px #efefef',
    borderRight: 'solid 1px #efefef',
    height: '100vh',
    overflow: 'auto'
  }
}, { name: 'Sidebar' })

export default Posts
