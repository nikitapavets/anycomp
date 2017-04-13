import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {setBreadcrumbs} from '../../actions/breadcrumbs';
import {handleRegistrationUser} from '../../actions/users';
import RegistrationPage from './RegistrationPage';

const mapStateToProps = (state) => {
    return {
        users: state.users,
        breadcrumbs: state.breadcrumbs,
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        handleRegistrationUser: bindActionCreators(handleRegistrationUser, dispatch),
        setBreadcrumbs: bindActionCreators(setBreadcrumbs, dispatch)
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(RegistrationPage);
