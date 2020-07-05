/* eslint-disable @typescript-eslint/no-explicit-any */
/* eslint-disable @typescript-eslint/explicit-module-boundary-types */
import { useCallback, useEffect } from 'react'

const useCallbackOnce = (func: (...args: any[]) => any) => {
  return useCallback(func, [])
}

const useEffectOnce = (func: () => any) => {
  useEffect(func, [])
}

const useEffectAsync = (asyncFunc: () => any, args: any[]) => {
  useEffect(() => {
    asyncFunc()
  }, args)
}

const useEffectOnceAsync = (asyncFunc: () => any) => {
  useEffect(() => {
    asyncFunc()
  }, [])
}

export { useCallbackOnce, useEffectOnce, useEffectAsync, useEffectOnceAsync }
