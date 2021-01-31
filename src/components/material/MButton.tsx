import React from "react"
import { Button, ButtonProps, CircularProgress } from "@material-ui/core"
import { makeStyles } from "@material-ui/core/styles"

interface Props extends ButtonProps {
  loading?: boolean
}

function MButton(props: Props) {
  const { loading = false, ...rest } = props

  const styles = useStyles()

  return (
    <Button
      {...rest}
      onClick={loading ? undefined : props.onClick}
      style={{ opacity: loading ? 0.5 : 1 }}
    >
      {loading &&
        <CircularProgress
          color="primary"
          classes={{
            root: styles.root,
            colorPrimary: styles.colorPrimary
          }}
          size={18}
        />
      }
      {props.children}
    </Button>
  )
}

const useStyles = makeStyles({
  root: {
    marginRight: 10
  },
  colorPrimary: {
    color: '#fff'
  }
}, { name: 'MButton' })

export default MButton
