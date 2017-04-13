import config from '../../core/config/general';
import fetch from 'isomorphic-fetch';
import {
    FETCH_USER_GET,
    FETCH_USER_SUCCESS,
    FETCH_USER_FAILURE,
    CHECK_AUTH_USER
} from '../actions-types/users';

function fetchUserGet() {
    return {
        type: FETCH_USER_GET
    }
}

function fetchUserSuccess() {
    return {
        type: FETCH_USER_SUCCESS
    }
}

function fetchUserFailure() {
    return {
        type: FETCH_USER_FAILURE
    }
}

function checkAuthUser() {
    return {
        type: CHECK_AUTH_USER
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
