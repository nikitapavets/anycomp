import config from '../../core/config/general';
import fetch from 'isomorphic-fetch';
import {
    FETCH_TVS_REQUEST,
    FETCH_TVS_SUCCESS,
    FETCH_TV_SUCCESS,
    FETCH_TVS_FAILURE,
    FETCH_TVS_SEARCH,
    FETCH_TV_GET
} from '../actions-types/tvs';

function fetchTvsRequest() {
    return {
        type: FETCH_TVS_REQUEST
    }
}

function fetchTvsSearch() {
    return {
        type: FETCH_TVS_SEARCH
    }
}

function fetchTvsGet() {
    return {
        type: FETCH_TV_GET
    }
}

function fetchTvsSuccess(payload) {
    return {
        type: FETCH_TVS_SUCCESS,
        payload
    }
}

function fetchTvSuccess(payload) {
    return {
        type: FETCH_TV_SUCCESS,
        payload
    }
}

function fetchTvsFailure(payload) {
    return {
        type: FETCH_TVS_FAILURE,
        payload
    }
}

export function handleLoadingTvs() {
    return function (dispatch) {
        dispatch(fetchTvsRequest());

        return fetch(`${config.server}/api/tvs`)
            .then(res => res.json())
            .then(json => dispatch(fetchTvsSuccess(json)))
            .catch(err => dispatch(fetchTvsFailure(err)));
    }
}

export function handleSearchTvs(searchForm) {
    return function (dispatch) {
        dispatch(fetchTvsSearch());

        return fetch(`${config.server}/api/tvs/search?text=${searchForm.text}`)
            .then(res => res.json())
            .then(json => dispatch(fetchTvsSuccess(json)))
            .catch(err => dispatch(fetchTvsFailure(err)));
    }
}

export function handleTvGet($tvId) {
    return function (dispatch) {
        dispatch(fetchTvsGet());

        return fetch(`${config.server}/api/tvs/${$tvId}`)
            .then(res => res.json())
            .then(json => dispatch(fetchTvSuccess(json)))
            .catch(err => dispatch(fetchTvsFailure(err)));
    }
}
