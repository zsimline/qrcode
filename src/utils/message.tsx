import React, { ReactNode, useState } from "react"
import ReactDOM from 'react-dom'
import { Snackbar } from "@material-ui/core"
import { Alert } from "@material-ui/lab"

type Severity = "success" | "info" | "warning" | "error"

interface Props {
  id: number
  severity: Severity
  content: ReactNode
  duration?: number | null
}

const queue: AnyObject<HTMLDivElement> = {}

function Message(props: Props) {
  const [open, setOpen] = useState<boolean>(true)

  const handleClose = () => {
    setOpen(false)
    const div = queue[props.id]
    div && document.body.removeChild(div)
    delete queue[props.id]
  }

  return (
    <Snackbar
      open={open}
      anchorOrigin={{ vertical: 'top', horizontal: 'center' }}
      autoHideDuration={props.duration || 3000}
      onClose={handleClose}
    >
      <Alert onClose={handleClose} severity={props.severity}>
        {props.content}
      </Alert>
    </Snackbar>
  )
}

export default {
  success: (content: ReactNode, duration?: number | null) => {
    const id = Date.now()
    const div = document.createElement('div')
    ReactDOM.render(<Message id={id} severity="success" content={content} duration={duration} />, div)
    document.body.appendChild(div)
    queue[id] = div
  },
  info: (content: ReactNode, duration?: number | null) => {
    const id = Date.now()
    const div = document.createElement('div')
    ReactDOM.render(<Message id={id} severity="info" content={content} duration={duration} />, div)
    document.body.appendChild(div)
    queue[id] = div
  },
  warning: (content: ReactNode, duration?: number | null) => {
    const id = Date.now()
    const div = document.createElement('div')
    ReactDOM.render(<Message id={id} severity="warning" content={content} duration={duration} />, div)
    document.body.appendChild(div)
    queue[id] = div
  },
  error: (content: ReactNode, duration?: number | null) => {
    const id = Date.now()
    const div = document.createElement('div')
    ReactDOM.render(<Message id={id} severity="error" content={content} duration={duration} />, div)
    document.body.appendChild(div)
    queue[id] = div
  }
}
