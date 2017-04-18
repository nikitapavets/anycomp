import config from '../../core/config/general';
import fetch from 'isomorphic-fetch';

import * as actions from '../actions-types/order';
import * as basket from './basket';

function orderUserRequest() {
    return {
        type: actions.ORDER_USER_REQUEST
    }
}

function orderUserSuccess(payload) {
    return {
        type: actions.ORDER_USER_SUCCESS,
        payload
    }
}

function orderUserFailure(payload) {
    return {
        type: actions.ORDER_USER_FAILURE,
        payload
    }
}

function orderProductsRequest() {
    return {
        type: actions.ORDER_PRODUCTS_REQUEST
    }
}

function orderProductsSuccess(payload) {
    return {
        type: actions.ORDER_PRODUCTS_SUCCESS,
        payload
    }
}

function orderProductsFailure(payload) {
    return {
        type: actions.ORDER_PRODUCTS_FAILURE,
        payload
    }
}

export function setOrderInitStep() {
    return {
        type: actions.SET_ORDER_INIT_STEP,
    }
}

export function setOrderUserStep() {
    return {
        type: actions.SET_ORDER_USER_STEP,
    }
}

export function handleOrderUserStep() {
    return function (dispatch) {
        dispatch(setOrderUserStep());
    }
}

export function handleOrderUser(data) {
    return function (dispatch) {
        dispatch(orderUserRequest());

        return fetch(`${config.server}/api/order/client`, {
            method: 'post',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
            body: data
        })
            .then(res => res.json())
            .then(json => {
                if (json.rang) {
                    dispatch(orderUserSuccess(json));
                } else {
                    dispatch(orderUserFailure(json));
                }
            })
            .catch(err => dispatch(orderUserFailure(err)));
    }
}

export function handleOrderProducts(data) {
    return function (dispatch) {
        dispatch(orderProductsRequest());

        return fetch(`${config.server}/api/order/products`, {
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
                    dispatch(orderProductsSuccess(json));
                    dispatch(basket.flushBasket());
                } else {
                    dispatch(orderProductsFailure(json));
                }
            })
            .catch(err => dispatch(orderUserFailure(err)));
    }
}
