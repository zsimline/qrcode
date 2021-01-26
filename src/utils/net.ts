/*
 * File: /src/utils/net.ts
 * Author: Mxsyx (mxsyxin@gmail.com)
 * Created At: 2021-01-25 10:29:38
 * -----
 * Last Modified: 2021-01-25 10:47:02
 * Modified By: Mxsyx (mxsyxin@gmail.com>)
 * -----
 * Lisense: GNU General Public License v3
 */

interface JSONPatch {
  op: 'add' | 'remove' | 'replace' | 'copy' | 'move' | 'test'
  from?: string
  path: string
  value: AnyObject
}

function post<T = AnyObject>(url: string, data: AnyObject) {
  return new Promise<T>(async (resolve, reject) => {
    try {
      const response = await fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
          'token': localStorage.getItem('token') || '',
          'content-type': 'application/json',
        },
        mode: 'cors',
      })
      const json = await response.json()
      response.ok ? resolve(json) : reject(json)
    } catch (error) {
      reject(error)
    }
  })
}

function del<T = AnyObject>(url: string) {
  return new Promise<T>(async (resolve, reject) => {
    try {
      const response = await fetch(url, {
        method: 'DELETE',
        headers: {
          'token': localStorage.getItem('token') || ''
        },
        mode: 'cors',
      })
      const json = await response.json()
      response.ok ? resolve(json) : reject(json)
    } catch (error) {
      reject(error)
    }
  })
}

function put<T = AnyObject>(url: string, data: AnyObject) {
  return new Promise<T>(async (resolve, reject) => {
    try {
      const response = await fetch(url, {
        method: 'PUT',
        body: JSON.stringify(data),
        headers: {
          'token': localStorage.getItem('token') || '',
          'content-type': 'application/json',
        },
        mode: 'cors',
      })
      const json = await response.json()
      response.ok ? resolve(json) : reject(json)
    } catch (error) {
      reject(error)
    }
  })
}

function get<T = AnyObject>(url: string, params: AnyObject) {
  return new Promise<T>(async (resolve, reject) => {
    try {
      const response = await fetch(`${url}?${new URLSearchParams(params).toString()}`, {
        method: 'GET',
        headers: {
          'token': localStorage.getItem('token') || ''
        },
        mode: 'cors',
      })
      const json = await response.json()
      response.ok ? resolve(json) : reject(json)
    } catch (error) {
      reject(error)
    }
  })
}

function patch<T = AnyObject>(url: string, data: JSONPatch | JSONPatch[]) {
  return new Promise<T>(async (resolve, reject) => {
    try {
      const response = await fetch(url, {
        method: 'PATCH',
        body: JSON.stringify(data),
        headers: {
          'token': localStorage.getItem('token') || '',
          'content-type': 'application/json-patch+json'
        },
        mode: 'cors',
      })
      const json = await response.json()
      response.ok ? resolve(json) : reject(json)
    } catch (error) {
      reject(error)
    }
  })
}

export default { post, del, put, get, patch }
