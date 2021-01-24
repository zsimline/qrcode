import { makeStyles } from "@material-ui/core/styles"

const useStyles = makeStyles({
  root: {
    display: 'flex',
    width: '80vw',
    height: '80vh',
    boxShadow: '0px 0px 10px #ddd',
    borderRadius: 16,
    margin: '10vh 10vw'
  },
  image: {
    width: '100%',
    height: '100%',
    borderRadius: 16,
    objectFit: 'cover'
  },
  btnSignIn: {
    lineHeight: '32px',
    width: 360,
    borderRadius: 16
  },
  btnSignup: {
    lineHeight: '32px',
    width: 360,
    borderRadius: 16
  },
  paper: {
    position: 'absolute',
    width: '100%',
    height: '100%',
    transformOrigin: 'left center',
    transformStyle: 'preserve-3d',
    transition: 'transform 1s ease',
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
  pageBack: {
    transform: 'scale(-1, 1)'
  },
  turnPage: {
    transform: 'perspective(1800px) rotateY(-180deg)'
  },
  textField: {
    width: 450,
    border: '1px solid #d8e3fa',
    borderRadius: 6,
    padding: '8px 16px'
  }
}, { name: 'Auth' })

export default useStyles
