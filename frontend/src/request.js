import axios from "axios"

function handleResponse({data: r}) {
    if (r === "ok") {
        return {isOk: true}
    } else if (r === "error") {
        return {isError: true}
    } else if (Array.isArray(r) && r.length === 2 && r[0] === "ok") {
        return {isOk: true, data: r[1]}
    } else if (Array.isArray(r) && r.length === 2 && r[0] === "error") {
        return {isError: true, data: r[1]}
    } else {
        throw new Error(r)
    }
}

export function unwrap(obj) {
    return obj.then(value => {
        if (value.isOk) {
            return value.data
        } else {
            throw new Error(JSON.stringify(value))
        }
    })
}

export function get(url, params = {}) {
    return axios.get(url, {params}).then(handleResponse)
}

export function post(url, params = {}) {
    return axios.post(url, params).then(handleResponse)
}

export function getUnwrap(url, params = {}) {
    return unwrap(get(url, params))
}

export function postUnwrap(url, params = {}) {
    return unwrap(post(url, params))
}
