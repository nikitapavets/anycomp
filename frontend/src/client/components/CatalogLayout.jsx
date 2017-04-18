import React from 'react';
import styled from 'styled-components';
import {colors, fontSizes} from '../libs/variables';
import {media} from '../libs/mixins';
import {Container} from '../libs/blocks';
import Breadcrumbs from './Breadcrumbs';
import SearchWidget from './Widgets/SearchWidget';
import RowWidget from './Layouts/RowWidget';
import CatalogItem from './CatalogItem';
import Loader from './Loader';
import DocumentMeta from 'react-document-meta';

const Catalog = styled.div`
    background-color: ${colors.white};
    
`;
const Catalog__Container = styled(Container)`
    background-color: ${colors.white};
`;
const Catalog__Header = styled.header`
    background-color: ${colors.white};
    font-size: ${fontSizes.xxl};
    font-weight: 800;
`;
const Catalog__Content = styled.section`
    padding: 15px 0;
`;

const Catalog__Search = styled.div`
    margin-bottom: 15px;
    width: 100%;
    ${media.desktop`
        width: 200px;
        float: left;
    `}
    ${media.wide`
        width: 250px;
    `}
`;
const Catalog__Items = styled.div`
    ${media.tablet`
        display: flex;
        flex-wrap: wrap;
    `}
    ${media.desktop`
        margin-left: 200px;
    `}
    ${media.wide`
        margin-left: 250px;
    `}
`;

export default class CatalogLayout extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            filter: {}
        };
    }

    handleSend = (filterItem) => {
        this.setState(_ => ({
            filter: {
                ..._.filter,
                ...filterItem
            }
        }));

        this.props.handleFilter({
            ...this.state.filter,
            ...filterItem
        });
    };

    render() {
        const meta = {
            title: `${this.props.title}: цены, сравнение товара, техническое обслуживание | AnyComp.by`,
            description: 'AnyComp.by - это удобный способ купить любой товар. Характеристики, сравнение ценовых предложений, техническое обслуживание.'
        };
        return (
            <Catalog>
                <DocumentMeta {...meta} />
                <Catalog__Container>
                    <Breadcrumbs data={this.props.breadcrumbs}/>
                    <Catalog__Header>{this.props.title}</Catalog__Header>
                    <Catalog__Content>
                        <Catalog__Search>
                            <RowWidget title='Поиск'>
                                <SearchWidget handleSend={this.handleSend}/>
                            </RowWidget>
                        </Catalog__Search>
                        <Catalog__Items>
                            {!this.props.items.isLoading
                                ?
                                this.props.items.data.map((item, index) =>
                                    <CatalogItem basketAddItem={this.props.basketAddItem} item={item} key={index}/>
                                )
                                :
                                <Loader/>
                            }
                        </Catalog__Items>
                    </Catalog__Content>
                </Catalog__Container>
            </Catalog>
        )
    }
}
