import React from "react"
import { makeStyles } from '@material-ui/core/styles'
import posterJpg from 'assets/poster.jpg'

function Poster() {
  const styles = useStyles()

  return (
    <img
      src={posterJpg}
      className={styles.image}
    />
  )
}

const useStyles = makeStyles({
  image: {
    width: '100%',
    height: '100%',
    objectFit: 'cover'
  }
}, { name: 'Auth' })

export default Poster
