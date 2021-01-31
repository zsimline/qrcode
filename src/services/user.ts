import net from "utils/net"
import { BASE_URL } from "constants/url"

export function signUp(payload: Payload.SignUp, options?: ServiceOptions) {
  const url = `${BASE_URL}/users`
  return net.post(url, payload)
}

export function signIn(payload: Payload.SignIn, options?: ServiceOptions) {
  const url = `${BASE_URL}/sessions`
  return net.post<Result.SignIn>(url, payload)
}

declare namespace Payload {
  interface SignUp {
    username: string
    password: string
  }

  interface SignIn {
    username: string
    password: string
  }
}

declare namespace Result {
  interface SignIn {
    token: string
  }
}
