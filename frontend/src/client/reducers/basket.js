import * as actionTypes from '../actions-types/basket';

const initialState = {
    data: [],
    isLoading: false,
    error: false
};

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

        case actionTypes.BASKET_ADD_ITEM: {
            let newBasketItem = action.payload;
            newBasketItem.index = state.data.length + 1;
            newBasketItem.quantity = 1;
            if (state.data.some(_ => _.title === newBasketItem.title)) {
                return {
                    ...state,
                    data: state.data.map(_ => {
                        if (_.title === newBasketItem.title) {
                            _.quantity = parseInt(_.quantity) + 1;
                        }
                        return _;
                    })
                };
            } else {
                return {
                    ...state,
                    data: [
                        ...state.data,
                        newBasketItem
                    ]
                };
            }
        }

        case actionTypes.BASKET_REMOVE_ITEM: {
            let removeIndex = action.payload;
            return {
                ...state,
                data: state.data.filter(_ => _.index != removeIndex)
            };
        }

        default: {
            return state
        }
    }
}
