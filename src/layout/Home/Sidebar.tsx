import React, { useState } from "react"
import { Avatar, Box, Button, Grid, Menu, MenuItem, Select, Typography } from "@material-ui/core"
import { makeStyles } from '@material-ui/core/styles'
import {
  AddOutlined,
  CollectionsOutlined, EmailOutlined, HomeOutlined, LocalOfferOutlined,
  NotificationsNoneOutlined, PersonOutlined
} from "@material-ui/icons"
import txJpg from 'assets/tx.jpg'

function Sidebar() {
  const [visible, setVisible] = useState<boolean>(false)

  const styles = useStyles()

  return (
    <Box className={styles.root}>
      <Typography variant="h5" className={styles.title}>Mozi</Typography>
      <Button className={styles.button}>
        <HomeOutlined className={styles.icon} />首页
      </Button>
      <Button className={styles.button}>
        <LocalOfferOutlined className={styles.icon} /> 话题
      </Button>
      <Button className={styles.button}>
        <NotificationsNoneOutlined className={styles.icon} /> 通知
      </Button>
      <Button className={styles.button}>
        <EmailOutlined className={styles.icon} /> 私信
      </Button>
      <Button className={styles.button}>
        <CollectionsOutlined className={styles.icon} /> 收藏
      </Button>
      <Button className={styles.button}>
        <PersonOutlined className={styles.icon} /> 我的
      </Button>
      <Button
        color="primary"
        className={styles.add}
        variant="contained"
      ><AddOutlined /> 发推 </Button>
      <Grid
        container
        className={styles.user}
        onClick={() => setVisible(true)}
        alignItems="center"
      >
        <Grid item>
          <Avatar src={txJpg} />
        </Grid>
        <Grid item>
          <Typography className={styles.username}>mxsyx</Typography>
          <Typography className={styles.sitename}>@Simline</Typography>
          <Menu open={visible}>
            <MenuItem>添加已有账号</MenuItem>
            <MenuItem>登出 mxsyx@Simline</MenuItem>
          </Menu>
        </Grid>
      </Grid>
    </Box>
  )
}

const useStyles = makeStyles({
  root: {
    position: 'relative',
    paddingTop: 20,
    minHeight: '100vh'
  },
  title: {
    padding: 10,
    textAlign: 'center'
  },
  button: {
    display: 'flex',
    fontSize: 20,
    padding: 8,
    width: 126,
    margin: 'auto',
    borderRadius: 20
  },
  icon: {
    transform: 'translateY(-1px)',
    marginRight: 6
  },
  add: {
    display: 'flex',
    margin: 'auto',
    width: 150,
    padding: 10,
    borderRadius: 24,
    backgroundColor: '#1ea1f1',
    color: '#fff'
  },
  user: {
    cursor: 'pointer',
    position: 'absolute',
    bottom: 50
  },
  username: {

  },
  sitename: {
    fontSize: 14,
    color: '#666'
  }
}, { name: 'Sidebar' })

export default Sidebar
