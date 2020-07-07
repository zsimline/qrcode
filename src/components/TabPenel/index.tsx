import React, { FC } from 'react'

interface TabPanelProps {
  children?: React.ReactNode
  index: number
  value: number
}

const TabPanel: FC<TabPanelProps> = props => {
  const { children, value, index } = props

  return (
    <div
      role="tabpanel"
      hidden={value !== index}
      id={`wrapped-tabpanel-${index}`}
      aria-labelledby={`wrapped-tab-${index}`}
    >
      {value === index && children}
    </div>
  )
}

export default TabPanel
