import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {handleLoadingTvs, handleSearchTvs} from '../../actions/tvs';
import {basketAddItem} from '../../actions/basket';
import {setBreadcrumbs} from '../../actions/breadcrumbs';
import TvsPage from './TvsPage';

const mapStateToProps = (state) => {
    return {
        tvs: state.tvs,
        breadcrumbs: state.breadcrumbs,
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        handleLoadingTvs: bindActionCreators(handleLoadingTvs, dispatch),
        handleSearchTvs: bindActionCreators(handleSearchTvs, dispatch),
        basketAddItem: bindActionCreators(basketAddItem, dispatch),
        setBreadcrumbs: bindActionCreators(setBreadcrumbs, dispatch)
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(TvsPage);
