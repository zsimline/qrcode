import React, { FC, useState } from 'react'
import { Select, MenuItem } from '@material-ui/core'
import { useCallbackOnce } from 'utils/hooks'

import TabPanel from 'components/TabPenel'

interface ColorProps {
  index: number
  value: number
}

const Color: FC<ColorProps> = props => {
  const { index, value } = props
  const [selectValue, setSelectValue] = useState<number>(0)

  const handleSelectChange = useCallbackOnce(
    (e: React.ChangeEvent<{ value: number }>) => {
      setSelectValue(e.target.value)
    }
  )

  return (
    <TabPanel index={index} value={value}>
      <input type="color" name="" id="" />
    </TabPanel>
  )
}

export default Color
