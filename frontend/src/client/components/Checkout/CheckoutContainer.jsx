import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {setBreadcrumbs} from '../../actions/breadcrumbs';
import {handleLogin, handleRegistrationUser} from '../../actions/users';
import CheckoutPage from './CheckoutPage';

const mapStateToProps = (state) => {
    return {
        users: state.users,
        basket: state.basket,
        breadcrumbs: state.breadcrumbs,
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        handleLogin: bindActionCreators(handleLogin, dispatch),
        setBreadcrumbs: bindActionCreators(setBreadcrumbs, dispatch),
        handleRegistrationUser: bindActionCreators(handleRegistrationUser, dispatch)
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(CheckoutPage);
