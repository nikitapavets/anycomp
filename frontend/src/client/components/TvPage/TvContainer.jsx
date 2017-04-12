import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {basketAddItem} from '../../actions/basket';
import {handleTvGet} from '../../actions/tvs';
import {setBreadcrumbs} from '../../actions/breadcrumbs';
import TvPage from './TvPage';

const mapStateToProps = (state) => {
    return {
        tvs: state.tvs,
        breadcrumbs: state.breadcrumbs
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        basketAddItem: bindActionCreators(basketAddItem, dispatch),
        setBreadcrumbs: bindActionCreators(setBreadcrumbs, dispatch),
        handleTvGet: bindActionCreators(handleTvGet, dispatch)
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(TvPage);
