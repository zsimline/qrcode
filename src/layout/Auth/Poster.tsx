import React from "react"
import { makeStyles } from '@material-ui/core/styles'

function Poster() {
  const styles = useStyles()

  return (
    <img
      src="http://pic.netbian.com/uploads/allimg/201215/193708-1608032228e0fb.jpg "
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
