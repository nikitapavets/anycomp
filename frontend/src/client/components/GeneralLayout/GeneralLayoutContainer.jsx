import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {handleLoadingBasket, basketRemoveItem} from '../../actions/basket';
import GeneralLayout from './GeneralLayout';

const mapStateToProps = (state) => {
    return {
        basket: state.basket
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        handleLoadingBasket: bindActionCreators(handleLoadingBasket, dispatch),
        basketRemoveItem: bindActionCreators(basketRemoveItem, dispatch)
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(GeneralLayout);
