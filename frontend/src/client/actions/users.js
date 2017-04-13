import config from '../../core/config/general';
import fetch from 'isomorphic-fetch';
import $ from 'jquery';
import {
    FETCH_USER_GET,
    FETCH_USER_SUCCESS,
    FETCH_USER_FAILURE,
    CHECK_AUTH_USER,
    REGISTRATION_USER,
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

function checkAuthUser() {
    return {
        type: CHECK_AUTH_USER
    }
}

function registrationUser() {
    return {
        type: REGISTRATION_USER
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
            body: JSON.stringify({

            })
        })
            .then(res => res.json())
            .then(json => dispatch(fetchUserSuccess(json)))
            .catch(err => dispatch(fetchUserFailure(err)));
    }
}
