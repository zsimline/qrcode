import {
  init,
  ExtractRematchStateFromModels,
  RematchDispatch,
} from '@rematch/core'
import * as models from './models'

const store = init({ models })

const rootState = store.getState()
const rootDispatch = store.dispatch

const useSelector = (): ExtractRematchStateFromModels<typeof models> => {
  return rootState
}

const useDispatch = (): RematchDispatch<typeof models> => {
  return rootDispatch
}

export { useSelector, useDispatch }
export default store
