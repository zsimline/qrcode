import React, { FC, useState } from 'react'
import { useCallbackOnce } from 'utils/hooks'

import TabPanel from 'components/TabPenel'
import { useSelector, useDispatch } from 'store'

interface ColorProps {
  index: number
  value: number
}

const Color: FC<ColorProps> = props => {
  const { index, value } = props
  const [selectValue, setSelectValue] = useState<number>(0)

  const { count } = useSelector().app
  const appDispatch = useDispatch().app

  const handleClick = () => {
    appDispatch.increment()
  }

  return (
    <TabPanel index={index} value={value}>
      <input type="color" name="" id="" />
      <div onClick={handleClick}>{count}</div>
    </TabPanel>
  )
}

export default Color
