import React from 'react';
import CatalogItemLayout from '../CatalogItemLayout';

export default class NotebooksPage extends React.Component {

    componentWillMount() {
        this.props.setBreadcrumbs([
            {
                title: 'Телевизоры',
                link: '/tvs'
            }
        ]);

        this.props.handleTvGet(this.props.params.id);
    }

    componentWillUpdate(nextProps) {
        if(nextProps.tvs.review.title != this.props.tvs.review.title) {
            document.title = `${nextProps.tvs.review.title} купить | AnyComp`
        }
    }

    render() {
        return (
            <div>
                <CatalogItemLayout {...this.props} item={this.props.tvs}/>
            </div>
        )
    }
}
