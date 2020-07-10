import { createModel } from '@rematch/core'

const appModel = createModel({
  name: 'app',
  state: {
    count: 0,
  },
  reducers: {
    increment: (state, payload) => {
      console.log({
        ...state,
        count: state.count + 1,
      })

      return {
        ...state,
        count: state.count + 1,
      }
    },
  },
  effects: {},
})

export default appModel
