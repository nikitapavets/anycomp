import config from '../../core/config/general';
import fetch from 'isomorphic-fetch';
import {browserHistory} from 'react-router'
import cookie from 'react-cookie'

import * as cookieParams from "../config/cookie";
import {
    FETCH_USER_GET,
    FETCH_USER_SUCCESS,
    FETCH_USER_FAILURE,
    CHECK_AUTH_USER,
    REGISTRATION_USER,
    LOGOUT_USER,
} from '../actions-types/users';

function fetchUserGet() {
    return {
        type: FETCH_USER_GET
    }
}

function fetchUserSuccess(payload) {
    return {
        type: FETCH_USER_SUCCESS,
        payload
    }
}

function fetchUserFailure(payload) {
    return {
        type: FETCH_USER_FAILURE,
        payload
    }
}

function checkAuthUser(payload) {
    return {
        type: CHECK_AUTH_USER,
        payload
    }
}

function registrationUser() {
    return {
        type: REGISTRATION_USER
    }
}

function logoutUser() {
    return {
        type: LOGOUT_USER
    }
}

export function handleUserGet() {
    return function (dispatch) {
        dispatch(fetchUserGet());

        return fetch(`${config.server}/api/users`)
            .then(res => res.json())
            .then(json => dispatch(fetchUserSuccess(json)))
            .catch(err => dispatch(fetchUserFailure(err)));
    }
}

export function handleCheckAuthUser() {
    return function (dispatch) {
        dispatch(checkAuthUser());
        const user = cookie.load(cookieParams.USER_COOKIE);
        if (!user.id) {
            return dispatch(fetchUserFailure(false));
        }

        return fetch(`${config.server}/api/users/${user.id}`)
            .then(res => res.json())
            .then(json => dispatch(fetchUserSuccess(json)))
            .catch(err => dispatch(fetchUserFailure(err)));
    }
}

export function handleLogout() {
    return function (dispatch) {
        cookie.remove(cookieParams.USER_COOKIE);
        dispatch(logoutUser());
    }
}

export function handleRegistrationUser(data) {
    return function (dispatch) {
        dispatch(registrationUser());

        return fetch(`${config.server}/api/users`, {
            method: 'post',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: data
        })
            .then(res => res.json())
            .then(json => {
                if (json.id) {
                    cookie.save(cookieParams.USER_COOKIE, json, {path: '/', maxAge: cookieParams.USER_MAX_AGE});
                    browserHistory.push('/');
                    dispatch(fetchUserSuccess(json));
                } else {
                    dispatch(fetchUserFailure(json))
                }
            })
            .catch(err => dispatch(fetchUserFailure(err)));
    }
}
