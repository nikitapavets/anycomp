import config from '../../core/config/general';
import fetch from 'isomorphic-fetch';
import {
    FETCH_NOTEBOOKS_REQUEST,
    FETCH_NOTEBOOKS_SUCCESS,
    FETCH_NOTEBOOK_SUCCESS,
    FETCH_NOTEBOOKS_FAILURE,
    FETCH_NOTEBOOKS_SEARCH,
    FETCH_NOTEBOOK_GET
} from '../actions-types/notebooks';

function fetchNotebooksRequest() {
    return {
        type: FETCH_NOTEBOOKS_REQUEST
    }
}

function fetchSearchNotebooks() {
    return {
        type: FETCH_NOTEBOOKS_SEARCH
    }
}

function fetchNotebookGet() {
    return {
        type: FETCH_NOTEBOOK_GET
    }
}

function fetchNotebooksSuccess(payload) {
    return {
        type: FETCH_NOTEBOOKS_SUCCESS,
        payload
    }
}

function fetchNotebookSuccess(payload) {
    return {
        type: FETCH_NOTEBOOK_SUCCESS,
        payload
    }
}

function fetchNotebooksFailure(payload) {
    return {
        type: FETCH_NOTEBOOKS_FAILURE,
        payload
    }
}

export function handleLoadingNotebooks() {
    return function (dispatch) {
        dispatch(fetchNotebooksRequest());

        return fetch(`${config.server}/api/notebooks`)
            .then(res => res.json())
            .then(json => dispatch(fetchNotebooksSuccess(json)))
            .catch(err => dispatch(fetchNotebooksFailure(err)));
    }
}

export function handleSearchNotebooks(searchForm) {
    return function (dispatch) {
        dispatch(fetchSearchNotebooks());

        return fetch(`${config.server}/api/notebooks/search?text=${searchForm.text}`)
            .then(res => res.json())
            .then(json => dispatch(fetchNotebooksSuccess(json)))
            .catch(err => dispatch(fetchNotebooksFailure(err)));
    }
}

export function handleNotebookGet(getParams) {
    return function (dispatch) {
        dispatch(fetchNotebookGet());

        return fetch(`${config.server}/api/notebooks/show?
                brand=${getParams.brand}&
                model=${getParams.model}&
                config=${getParams.config}`)
            .then(res => res.json())
            .then(json => {
                dispatch(fetchNotebookSuccess(json));
                dispatch(fetchNotebookSuccess(json));
            })
            .catch(err => dispatch(fetchNotebooksFailure(err)));
    }
}
