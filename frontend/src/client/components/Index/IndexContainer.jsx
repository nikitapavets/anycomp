import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {handleLoadingNotebooks} from '../../actions/notebooks';
import {handleLoadingTvs} from '../../actions/tvs';
import {handleLoadingPopularProducts} from '../../actions/popularProducts';
import {basketAddItem} from '../../actions/basket';
import Index from './Index';

const mapStateToProps = (state) => {
    return {
        notebooks: state.notebooks,
        tvs: state.tvs,
        popularProducts: state.popularProducts
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        handleLoadingNotebooks: bindActionCreators(handleLoadingNotebooks, dispatch),
        handleLoadingTvs: bindActionCreators(handleLoadingTvs, dispatch),
        handleLoadingPopularProducts: bindActionCreators(handleLoadingPopularProducts, dispatch),
        basketAddItem: bindActionCreators(basketAddItem, dispatch),
    }
};

export default connect(mapStateToProps, mapDispatchToProps)(Index);
