import cookie from 'react-cookie'

import * as cookieParams from "../config/cookie";
import * as actions from '../actions-types/basket';

function fetchBasketRequest() {
    return {
        type: actions.FETCH_BASKET_REQUEST
    }
}

function fetchBasketSuccess(payload) {
    return {
        type: actions.FETCH_BASKET_SUCCESS,
        payload
    }
}

function fetchBasketFailure(payload) {
    return {
        type: actions.FETCH_BASKET_FAILURE,
        payload
    }
}

export function basketAddItem(newBasketItem) {
    return {
        type: actions.BASKET_ADD_ITEM,
        payload: newBasketItem
    }
}

export function basketRemoveItem(basketItemIndexForRemove) {
    return {
        type: actions.BASKET_REMOVE_ITEM,
        payload: basketItemIndexForRemove
    }
}

export function flushBasket() {
    cookie.remove(cookieParams.BASKET_COOKIE);
    return {
        type: actions.FLUSH_BASKET
    }
}

export function handleLoadingBasket() {
    return function (dispatch) {
        dispatch(fetchBasketRequest());
        const basket = cookie.load(cookieParams.BASKET_COOKIE);
        if (basket) {
            dispatch(fetchBasketSuccess(basket));
        } else {
            dispatch(fetchBasketFailure());
        }
    }
}
