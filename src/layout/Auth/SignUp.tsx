import React, { useState } from "react"
import { Grid, Typography, Input, FormHelperText, InputAdornment, IconButton } from "@material-ui/core"
import { makeStyles, useTheme } from '@material-ui/core/styles'
import { Visibility, VisibilityOff } from "@material-ui/icons"
import classNames from "classnames"
import { useForm } from "react-hook-form"
import message from "utils/message"
import { MButton } from "components/material"
import services from "services"

function SignUp() {
  const theme = useTheme()
  const styles = useStyles()

  const { register, handleSubmit, errors } = useForm()
  const [loading, setLoading] = useState<boolean>(false)
  const [showPwd, setShowPwd] = useState<boolean>(false)

  const onSubmit = (data) => {
    setLoading(true)
    services.user.signUp({
      username: data.username,
      password: data.password
    })
      .then(() => {
        message.success('Sign up successful!')
      })
      .finally(() => {
        setLoading(false)
      })
  }

  return (
    <Grid
      container
      direction="column"
      spacing={2}
      className={classNames(styles.page, styles.pageFront)}
      alignItems="center"
      justify="center"
    >
      <Grid item>
        <Typography variant="h4" color="textPrimary" style={{ width: 450 }}>Sign up</Typography>
      </Grid>
      <Grid item style={{ paddingBottom: 0, width: 450 }}>
        <Typography color="textPrimary">Work Email</Typography>
      </Grid>
      <Grid item>
        <Input
          name="username"
          type="email"
          placeholder="user@example.com"
          disableUnderline
          inputRef={register({
            required: 'Please enter a valid email.'
          })}
          style={{ borderColor: errors.password ? theme.palette.error.light : '#d8e3fa' }}
          error={!!errors.password}
          className={styles.textField}
        />
        <FormHelperText style={{ color: theme.palette.error.main }}>
          {errors.username?.message}
        </FormHelperText>
      </Grid>
      <Grid item style={{ paddingBottom: 0, width: 450 }}>
        <Typography color="textPrimary">Password</Typography>
      </Grid>
      <Grid item>
        <Input
          name="password"
          type={showPwd ? 'text' : 'password'}
          placeholder="······"
          disableUnderline
          inputRef={register({
            required: 'Please enter a valid password.'
          })}
          style={{ borderColor: errors.password ? theme.palette.error.light : '#d8e3fa' }}
          error={!!errors.password}
          className={styles.textField}
          endAdornment={
            <InputAdornment position="end">
              <IconButton onClick={() => setShowPwd(!showPwd)}>
                {showPwd ? <Visibility /> : <VisibilityOff />}
              </IconButton>
            </InputAdornment>
          }
        />
        <FormHelperText style={{ color: theme.palette.error.main }}>
          {errors.password?.message}
        </FormHelperText>
      </Grid>
      <Grid item>
        <MButton
          color="primary"
          variant="contained"
          onClick={handleSubmit(onSubmit)}
          className={styles.btnSignIn}
          loading={loading}
        >Submit</MButton>
      </Grid>
    </Grid>
  )
}

const useStyles = makeStyles({
  btnSignIn: {
    width: 360,
    borderRadius: 16
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
  textField: {
    width: 450,
    border: '1px solid #d8e3fa',
    borderRadius: 6,
    padding: '8px 16px'
  }
}, { name: 'Auth' })

export default SignUp
