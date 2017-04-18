import * as actionTypes from '../actions-types/basket';
import cookie from 'react-cookie'
import * as cookieParams from "../config/cookie";

const initialState = {
    data: [],
    isLoading: false,
    error: false
};

const updateCookie = (basket) =>
    cookie.save(cookieParams.BASKET_COOKIE, basket, {path: '/', maxAge: cookieParams.MAX_AGE});


export default function basket(state = initialState, action) {
    switch (action.type) {
        case actionTypes.FETCH_BASKET_REQUEST:
            return {
                ...state,
                isLoading: true
            };

        case actionTypes.FETCH_BASKET_SUCCESS:
            return {
                ...state,
                data: action.payload,
                isLoading: false
            };

        case actionTypes.FETCH_BASKET_FAILURE:
            return {
                ...state,
                error: action.payload
            };

        case actionTypes.FLUSH_BASKET:
            return {
                ...state,
                data: initialState.data
            };

        case actionTypes.BASKET_ADD_ITEM: {
            let newBasketItem = action.payload;
            newBasketItem.index = state.data.length + 1;
            newBasketItem.quantity = 1;
            let basket = [];
            if (state.data.some(_ => _.title === newBasketItem.title)) {
                basket = state.data.map(_ => {
                    if (_.title === newBasketItem.title) {
                        _.quantity = parseInt(_.quantity) + 1;
                    }
                    return _;
                });
            } else {
                basket = [
                    ...state.data,
                    newBasketItem
                ]
            }
            updateCookie(basket);
            return {
                ...state,
                data: basket
            }
        }

        case actionTypes.BASKET_REMOVE_ITEM: {
            let removeIndex = action.payload;
            const basket = state.data.filter(_ => _.index != removeIndex);
            updateCookie(basket);
            return {
                ...state,
                data: basket
            };
        }

        default: {
            return state
        }
    }
}
