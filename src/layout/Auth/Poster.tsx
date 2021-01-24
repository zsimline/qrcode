import React from "react"
import useStyles from "./styles"

function Poster() {
  const styles = useStyles()

  return (
    <img
      src="http://pic.netbian.com/uploads/allimg/201215/193708-1608032228e0fb.jpg "
      className={styles.image}
    />
  )
}


export default Poster
