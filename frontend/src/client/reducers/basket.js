export default function basket(state = [], action) {
    switch (action.type) {
        case 'INIT_BASKET': {
            return action.payload;
        }
        case 'ADD_TO_BASKET': {
            let newBasketItem = action.payload;
            newBasketItem.index = state.length + 1;
            newBasketItem.quantity = 1;
            if (state.some(_ => _.title === newBasketItem.title)) {
                return state.map(_ => {
                    if (_.title === newBasketItem.title) {
                        _.quantity = parseInt(_.quantity) + 1;
                    }
                    return _;
                });
            } else {
                return [
                    ...state,
                    newBasketItem
                ];
            }
        }
        case 'REMOVE_FROM_BASKET': {
            let removeIndex = action.payload;
            return state.filter(_ => _.index != removeIndex);
        }
        default: {
            return state
        }
    }
}
