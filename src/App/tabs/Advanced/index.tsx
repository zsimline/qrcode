import React, { FC, useState } from 'react'
import { Select, MenuItem } from '@material-ui/core'
import { useCallbackOnce } from 'utils/hooks'

import TabPanel from 'components/TabPenel'

interface AdvancedProps {
  index: number
  value: number
}

const Advanced: FC<AdvancedProps> = props => {
  const { index, value } = props
  const [selectValue, setSelectValue] = useState<number>(0)

  const handleSelectChange = useCallbackOnce(
    (e: React.ChangeEvent<{ value: number }>) => {
      setSelectValue(e.target.value)
    }
  )

  return (
    <TabPanel index={index} value={value}>
      <Select value={selectValue} onChange={handleSelectChange} label="容错率">
        <MenuItem value="">
          <em>None</em>
        </MenuItem>
        <MenuItem value={0}>30%</MenuItem>
        <MenuItem value={1}>25%</MenuItem>
        <MenuItem value={2}>15%</MenuItem>
        <MenuItem value={3}>7%</MenuItem>
      </Select>
    </TabPanel>
  )
}

export default Advanced
