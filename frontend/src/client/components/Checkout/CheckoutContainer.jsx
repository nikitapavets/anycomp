import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {setBreadcrumbs} from '../../actions/breadcrumbs';
import {handleOrderUser, handleOrderUserStep, handleOrderProducts} from '../../actions/order';
import {handleLogin} from '../../actions/users';
import CheckoutPage from './CheckoutPage';

const mapStateToProps = (state) => {
    return {
        users: state.users,
        basket: state.basket,
        breadcrumbs: state.breadcrumbs,
        order: state.order
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        handleOrderUser: bindActionCreators(handleOrderUser, dispatch),
        handleOrderProducts: bindActionCreators(handleOrderProducts, dispatch),
        handleOrderUserStep: bindActionCreators(handleOrderUserStep, dispatch),
        handleLogin: bindActionCreators(handleLogin, dispatch),
        setBreadcrumbs: bindActionCreators(setBreadcrumbs, dispatch)
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(CheckoutPage);
